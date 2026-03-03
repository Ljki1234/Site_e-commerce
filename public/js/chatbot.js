document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('chatbot-toggle');
    const panel = document.getElementById('chatbot-panel');
    const closeBtn = document.getElementById('chatbot-close');
    const form = document.getElementById('chatbot-form');
    const input = document.getElementById('chatbot-input');
    const messages = document.getElementById('chatbot-messages');
    const quickButtons = document.querySelectorAll('.chatbot-quick');

    if (!toggleBtn || !panel || !form || !input || !messages) return;

    function openPanel() {
        panel.classList.remove('chatbot-hidden');
        input.focus();
    }

    function closePanel() {
        panel.classList.add('chatbot-hidden');
    }

    toggleBtn.addEventListener('click', () => {
        if (panel.classList.contains('chatbot-hidden')) {
            openPanel();
        } else {
            closePanel();
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closePanel);
    }

    function appendMessage(text, type) {
        const wrapper = document.createElement('div');
        wrapper.className = 'chatbot-message ' + (type === 'user' ? 'chatbot-user' : 'chatbot-bot');

        const bubble = document.createElement('div');
        bubble.className = 'bubble';
        bubble.textContent = text;

        wrapper.appendChild(bubble);
        messages.appendChild(wrapper);
        messages.scrollTop = messages.scrollHeight;
    }

    quickButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const text = btn.getAttribute('data-text') || btn.textContent.trim();
            input.value = text;
            input.focus();
        });
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        let text = input.value.trim();
        if (!text) return;

        if (text.length > 255) {
            text = text.substring(0, 255);
        }

        appendMessage(text, 'user');
        input.value = '';

        fetch('chatbot.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message: text })
        })
            .then(res => {
                if (res.status === 429) {
                    return { success: false, message: 'Too many requests. Please try again in a minute.' };
                }
                return res.json();
            })
            .then(data => {
                if (!data) return;
                if (!data.success) {
                    appendMessage(data.message || 'Error while processing your message.', 'bot');
                } else {
                    appendMessage(data.bot_response, 'bot');
                }
            })
            .catch(err => {
                console.error(err);
                appendMessage('A network error occurred. Please try again later.', 'bot');
            });
    });
});

