import EmblaCarousel from 'embla-carousel';
import Autoplay from 'embla-carousel-autoplay';

/* Embla: سلايدرات (وجهات / رحلات / آراء) */
function initEmblaRoot(root) {
    const viewport = root.querySelector('.embla__viewport');
    if (!viewport) {
        return;
    }

    const rawDelay = root.dataset.emblaAutoplay;
    const plugins = [];
    if (rawDelay) {
        const delay = Math.max(2000, parseInt(rawDelay, 10) || 0);
        plugins.push(Autoplay({ delay, stopOnInteraction: true, stopOnMouseEnter: true }));
    }

    // يجب أن يطابق <html dir> — الوضع الإنجليزي ltr وإلا يتعطل التمرير والسحب
    const pageDir = document.documentElement.getAttribute('dir') || 'rtl';
    const direction = pageDir === 'rtl' ? 'rtl' : 'ltr';

    const embla = EmblaCarousel(
        viewport,
        {
            direction,
            align: 'start',
            containScroll: 'trimSnaps',
            loop: true,
            skipSnaps: false,
            dragFree: false,
        },
        plugins,
    );

    const prevBtn = root.querySelector('[data-embla-prev]');
    const nextBtn = root.querySelector('[data-embla-next]');
    const dotsNode = root.querySelector('[data-embla-dots]');

    const scrollPrev = () => embla.scrollPrev();
    const scrollNext = () => embla.scrollNext();

    const applyNavState = () => {
        if (prevBtn) {
            prevBtn.disabled = !embla.canScrollPrev();
        }
        if (nextBtn) {
            nextBtn.disabled = !embla.canScrollNext();
        }
    };

    const renderDots = () => {
        if (!dotsNode) {
            return;
        }
        dotsNode.replaceChildren();
        const total = embla.scrollSnapList().length;
        if (total <= 1) {
            return;
        }
        for (let i = 0; i < total; i += 1) {
            const b = document.createElement('button');
            b.type = 'button';
            b.className =
                'h-1.5 w-1.5 rounded-full border-0 transition-all duration-300 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-amber-400/60 md:h-2 md:w-2';
            b.setAttribute(
                'aria-label',
                pageDir === 'rtl' ? `انتقال للشريحة ${i + 1}` : `Go to slide ${i + 1}`,
            );
            b.addEventListener('click', () => embla.scrollTo(i), { passive: true });
            dotsNode.appendChild(b);
        }
        const updateDots = () => {
            const idx = embla.selectedScrollSnap();
            Array.from(dotsNode.children).forEach((el, n) => {
                const active = n === idx;
                el.className =
                    (active
                        ? 'h-2.5 w-5 rounded-full bg-amber-400/90 shadow-[0_0_10px_#fbbf24] md:h-2.5'
                        : 'h-1.5 w-1.5 rounded-full bg-slate-300/90 md:h-2 md:w-2') +
                    ' border-0 transition-all duration-300 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-amber-400/60';
            });
        };
        embla.on('reInit', updateDots);
        embla.on('select', () => {
            updateDots();
            applyNavState();
        });
        updateDots();
    };

    if (prevBtn) {
        prevBtn.addEventListener('click', scrollPrev, { passive: true });
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', scrollNext, { passive: true });
    }

    embla.on('reInit', applyNavState);
    embla.on('select', applyNavState);
    embla.on('init', () => {
        applyNavState();
    });

    renderDots();
    applyNavState();
}

document.querySelectorAll('[data-embla-root]').forEach((root) => {
    try {
        initEmblaRoot(root);
    } catch (e) {
        console.error('[embla]', e);
    }
});

/* ظهور تدريجي عند التمرير */
if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const io = new IntersectionObserver(
        (entries) => {
            for (const en of entries) {
                if (en.isIntersecting) {
                    en.target.classList.add('reveal-in');
                    io.unobserve(en.target);
                }
            }
        },
        { root: null, rootMargin: '0px 0px -5% 0px', threshold: 0.08 },
    );
    document.querySelectorAll('[data-reveal]').forEach((el) => io.observe(el));
} else {
    document.querySelectorAll('[data-reveal]').forEach((el) => el.classList.add('reveal-in'));
}
