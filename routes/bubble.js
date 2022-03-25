const root = document.querySelector("#app-main");
let { innerHeight, innerWidth } = window;
console.log(innerHeight, innerWidth);
if (innerHeight < 300) {
    innerHeight = 350;
}
if (innerWidth < 300) {
    innerWidth = 750;
}

class Bubble {
    constructor() {
        this.bubbleSpan = undefined;
        this.handleNewBubble();
        this.color = this.randomColor();

        this.posY = this.randomNumber(innerHeight - 20, 20);
        this.posX = this.randomNumber(innerWidth - 20, 20);

        this.bubbleSpan.style.top = this.posY + "px";
        this.bubbleSpan.style.left = this.posX + "px";

        // setting height and width of the bubble
        this.height = this.randomNumber(60, 20);
        this.width = this.height;

        this.bubbleEnd.call(this.bubbleSpan, this.randomNumber(6000, 3000));
    }

    // creates and appends a new bubble in the DOM
    handleNewBubble() {
        this.bubbleSpan = document.createElement("span");
        this.bubbleSpan.classList.add("bubble");
        root.append(this.bubbleSpan);
        this.handlePosition();
        this.bubbleSpan.addEventListener("click", this.bubbleEnd);
    }

    handlePosition() {
        // positioning the bubble in different random X and Y
        const randomY = this.randomNumber(60, -60);
        const randomX = this.randomNumber(60, -60);

        this.bubbleSpan.style.backgroundColor = this.color;
        this.bubbleSpan.style.height = this.height + "px";
        this.bubbleSpan.style.width = this.height + "px";

        this.posY = this.randomNumber(innerHeight - 20, 20);
        this.posX = this.randomNumber(innerWidth - 20, 20);

        this.bubbleSpan.style.top = this.posY + "px";
        this.bubbleSpan.style.left = this.posX + "px";

        const randomSec = this.randomNumber(4000, 200);
        setTimeout(this.handlePosition.bind(this), randomSec); // calling for re-position of bubble
    }

    randomNumber(max, min) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    randomColor() {
        // return `rgba(
        // ${this.randomNumber(0, 255)},
        // ${this.randomNumber(0, 255)},
        // ${this.randomNumber(0, 255)}, 
        // ${this.randomNumber(0.1, 1)})`;

        return `rgba(
            0,
            0,
            ${this.randomNumber(100, 255)}, 
            ${this.randomNumber(0.1, 1)})`;
    }

    bubbleEnd(removingTime = 0) {
        setTimeout(
            () => {
                try {
                    requestAnimationFrame(this.classList.add("bubble--bust"));
                } catch (error) {
                    //console.log(error);
                }
            },
            removingTime === 0 ? removingTime : removingTime - 100
        );

        setTimeout(() => {
            try {
                requestAnimationFrame(this.remove());
                requestAnimationFrame(new Bubble());
            } catch (error) {
                //console.log(error);
            }
        }, removingTime);
    }
}

// creating many bubble instance

setInterval(function() {
    try {
        requestAnimationFrame(new Bubble());
    } catch (error) {
        //console.log(error);
    }
}, 300);