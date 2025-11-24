// This script handles the cool background effects!
// I made two classes, one for stars and one for sakura petals.

class StarBackground {
    constructor() {
        // Create a canvas element to draw on
        this.canvas = document.createElement('canvas');
        this.ctx = this.canvas.getContext('2d');

        // Make it cover the whole screen
        this.canvas.style.position = 'fixed';
        this.canvas.style.top = '0';
        this.canvas.style.left = '0';
        this.canvas.style.width = '100%';
        this.canvas.style.height = '100%';
        this.canvas.style.zIndex = '-1'; // Put it behind everything
        this.canvas.style.pointerEvents = 'none'; // Click through it

        // Dark background for space
        this.canvas.style.background = 'linear-gradient(to bottom, #0f0c29, #302b63, #24243e)';

        this.stars = [];
        this.active = false;

        // Handle window resize
        this.resizeHandler = () => this.resize();
    }

    init() {
        if (this.active) return;

        document.body.appendChild(this.canvas);
        window.addEventListener('resize', this.resizeHandler);

        this.resize();
        this.createStars();
        this.active = true;
        this.animate();

        // Make body transparent so we can see the canvas
        document.body.style.backgroundColor = 'transparent';
    }

    remove() {
        if (!this.active) return;

        window.removeEventListener('resize', this.resizeHandler);
        if (this.canvas.parentNode) {
            this.canvas.parentNode.removeChild(this.canvas);
        }
        this.active = false;

        // Reset body background
        document.body.style.backgroundColor = '';
    }

    resize() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
    }

    createStars() {
        this.stars = [];
        // 1000 stars is a lot!
        const count = 1000;
        for (let i = 0; i < count; i++) {
            this.stars.push({
                x: Math.random() * this.canvas.width,
                y: Math.random() * this.canvas.height,
                size: Math.random() * 2,
                speed: Math.random() * 0.5 + 0.1
            });
        }
    }

    animate() {
        if (!this.active) return;

        // Clear the screen
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.ctx.fillStyle = 'white';

        // Move and draw each star
        this.stars.forEach(star => {
            star.y -= star.speed; // Move up

            // If it goes off screen, put it back at bottom
            if (star.y < 0) star.y = this.canvas.height;

            // Twinkle effect
            const brightness = Math.random() * 0.5 + 0.5;
            this.ctx.globalAlpha = brightness;

            this.ctx.beginPath();
            this.ctx.arc(star.x, star.y, star.size, 0, Math.PI * 2);
            this.ctx.fill();
        });

        // Keep animating
        requestAnimationFrame(() => this.animate());
    }
}

class SakuraBackground {
    constructor() {
        this.canvas = document.createElement('canvas');
        this.ctx = this.canvas.getContext('2d');

        this.canvas.style.position = 'fixed';
        this.canvas.style.top = '0';
        this.canvas.style.left = '0';
        this.canvas.style.width = '100%';
        this.canvas.style.height = '100%';
        this.canvas.style.zIndex = '-1';
        this.canvas.style.pointerEvents = 'none';

        // Light background for sakura
        this.canvas.style.background = 'linear-gradient(to bottom, #fdfbfb, #ebedee)';

        this.petals = [];
        this.active = false;
        this.resizeHandler = () => this.resize();
    }

    init() {
        if (this.active) return;

        document.body.appendChild(this.canvas);
        window.addEventListener('resize', this.resizeHandler);

        this.resize();
        this.createPetals();
        this.active = true;
        this.animate();

        document.body.style.backgroundColor = 'transparent';
    }

    remove() {
        if (!this.active) return;

        window.removeEventListener('resize', this.resizeHandler);
        if (this.canvas.parentNode) {
            this.canvas.parentNode.removeChild(this.canvas);
        }
        this.active = false;
        document.body.style.backgroundColor = '';
    }

    resize() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
    }

    createPetals() {
        this.petals = [];
        const count = 100;
        for (let i = 0; i < count; i++) {
            this.petals.push({
                x: Math.random() * this.canvas.width,
                y: Math.random() * this.canvas.height,
                size: Math.random() * 10 + 5,
                speedY: Math.random() * 1 + 0.5,
                speedX: Math.random() * 2 - 1,
                rotation: Math.random() * 360,
                rotationSpeed: Math.random() * 2 - 1
            });
        }
    }

    animate() {
        if (!this.active) return;

        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.ctx.fillStyle = '#ffb7b2'; // Pink color

        this.petals.forEach(petal => {
            petal.y += petal.speedY; // Move down
            petal.x += Math.sin(petal.y * 0.01) + petal.speedX; // Sway side to side
            petal.rotation += petal.rotationSpeed; // Spin

            // Loop around
            if (petal.y > this.canvas.height) petal.y = -20;
            if (petal.x > this.canvas.width) petal.x = 0;
            if (petal.x < 0) petal.x = this.canvas.width;

            this.ctx.save();
            this.ctx.translate(petal.x, petal.y);
            this.ctx.rotate(petal.rotation * Math.PI / 180);
            this.ctx.globalAlpha = 0.7;

            // Draw a petal (looks kinda like a heart)
            this.ctx.beginPath();
            this.ctx.moveTo(0, 0);
            this.ctx.bezierCurveTo(petal.size / 2, -petal.size / 2, petal.size, 0, 0, petal.size);
            this.ctx.bezierCurveTo(-petal.size, 0, -petal.size / 2, -petal.size / 2, 0, 0);
            this.ctx.fill();

            this.ctx.restore();
        });

        requestAnimationFrame(() => this.animate());
    }
}

// Create instances
window.starBg = new StarBackground();
window.sakuraBg = new SakuraBackground();
