document.addEventListener('DOMContentLoaded', function () {
    const section = document.getElementById('testimonials-section');
    if (!section) return;

    const slides = section.querySelectorAll('.testimonial-slide');
    const dots = section.querySelectorAll('.testimonial-dot');
    if (!slides.length || !dots.length) return;

    let current = 0;

    function updateSlides(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.remove('hidden');
            } else {
                slide.classList.add('hidden');
            }
        });

        dots.forEach((dot, i) => {
            if (i === index) {
                dot.classList.add('bg-[#E91E63]', 'ring-2', 'ring-[#E91E63]', 'ring-offset-2', 'scale-110');
                dot.classList.remove('border-slate-300');
            } else {
                dot.classList.remove('bg-[#E91E63]', 'ring-2', 'ring-[#E91E63]', 'ring-offset-2', 'scale-110');
                dot.classList.add('border-slate-300');
            }
        });
    }

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            const target = parseInt(dot.getAttribute('data-target'), 10);
            current = target;
            updateSlides(current);
        });
    });

    // Auto-play toutes les 3 secondes
    setInterval(() => {
        current = (current + 1) % slides.length;
        updateSlides(current);
    }, 3000);

    // État initial
    updateSlides(current);
});

