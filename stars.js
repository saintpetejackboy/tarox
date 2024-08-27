const style = document.createElement('style');
style.textContent = `
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: hidden;
        background: #000000;
    }
    .space {
        position: fixed;
        top: 0;
        left: 0;
        width: 200%;
        height: 200%;
        pointer-events: none;
    }
    .star {
        position: absolute;
        background-color: #ffffff;
        border-radius: 50%;
        animation: twinkle var(--twinkle-duration) infinite;
    }
    .shooting-star {
        position: absolute;
        width: var(--size);
        height: var(--size);
        background: linear-gradient(45deg, var(--color), transparent);
        border-radius: 50%;
        filter: blur(1px);
        opacity: 0;
    }
    @keyframes twinkle {
        0%, 100% { opacity: var(--max-opacity); }
        50% { opacity: var(--min-opacity); }
    }
`;
document.head.appendChild(style);

class Star {
    constructor(container) {
        this.element = document.createElement('div');
        this.element.className = 'star';
        this.reset();
        container.appendChild(this.element);
    }

    reset() {
        const size = Math.random() * 2 + 1;
        this.element.style.width = `${size}px`;
        this.element.style.height = `${size}px`;
        this.element.style.left = `${Math.random() * 100}%`;
        this.element.style.top = `${Math.random() * 100}%`;
        this.element.style.setProperty('--max-opacity', Math.random() * 0.5 + 0.5);
        this.element.style.setProperty('--min-opacity', Math.random() * 0.1);
        this.element.style.setProperty('--twinkle-duration', `${Math.random() * 5 + 2}s`);
    }
}

class ShootingStar {
    constructor(container) {
        this.element = document.createElement('div');
        this.element.className = 'shooting-star';
        this.container = container;
        this.reset();
        container.appendChild(this.element);
    }

    reset() {
        const size = Math.random() * 4 + 2;
        this.element.style.setProperty('--size', `${size}px`);

        const colors = ['#ffffff', '#ffe9c4', '#d4fbff', '#ffcccb'];
        this.element.style.setProperty('--color', colors[Math.floor(Math.random() * colors.length)]);

        this.startX = Math.random() * 100;
        this.startY = Math.random() * 100;
        this.element.style.left = `${this.startX}%`;
        this.element.style.top = `${this.startY}%`;

        const angle = Math.random() * 60 - 30; // -30 to 30 degrees
        const distance = Math.random() * 200 + 100;
        this.endX = this.startX + Math.cos(angle * Math.PI / 180) * distance;
        this.endY = this.startY + Math.sin(angle * Math.PI / 180) * distance;

        this.progress = 0;
        this.speed = Math.random() * 0.2 + 0.1;
    }

    update() {
        this.progress += this.speed;
        if (this.progress >= 1) {
            this.reset();
            return;
        }

        const x = this.startX + (this.endX - this.startX) * this.progress;
        const y = this.startY + (this.endY - this.startY) * this.progress;
        this.element.style.left = `${x}%`;
        this.element.style.top = `${y}%`;

        const opacity = Math.sin(this.progress * Math.PI);
        this.element.style.opacity = opacity;
    }
}

class SpaceAnimation {
    constructor() {
        this.container = document.createElement('div');
        this.container.className = 'space';
        document.body.appendChild(this.container);

        this.stars = [];
        this.shootingStars = [];
        this.lastTime = 0;
        this.xOffset = 0;
        this.yOffset = 0;

        this.createStars();
        this.createShootingStars();
        this.animate();
    }

    createStars() {
        for (let i = 0; i < 1000; i++) {
            this.stars.push(new Star(this.container));
        }
    }

    createShootingStars() {
        for (let i = 0; i < 5; i++) {
            this.shootingStars.push(new ShootingStar(this.container));
        }
    }

    moveStars(deltaTime) {
        const speed = 0.01;
        this.xOffset -= speed * deltaTime;
        this.yOffset -= speed * deltaTime * 0.5;

        if (this.xOffset <= -50) this.xOffset += 50;
        if (this.yOffset <= -50) this.yOffset += 50;

        this.container.style.transform = `translate(${this.xOffset}%, ${this.yOffset}%)`;
    }

    animate(currentTime) {
        if (!this.lastTime) this.lastTime = currentTime;
        const deltaTime = currentTime - this.lastTime;
        this.lastTime = currentTime;

        this.moveStars(deltaTime);

        this.shootingStars.forEach(star => star.update());

        requestAnimationFrame(this.animate.bind(this));
    }
}

// Initialize the space animation
new SpaceAnimation();