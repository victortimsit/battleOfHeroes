class SynopsisDisplay {
    constructor(displayButtonClass, windowToDisplayClass, displayClass, unDisplayClass) {
        this.displayButtons = document.querySelectorAll('.' + displayButtonClass)
        this.windowsToDisplay = document.querySelectorAll('.' + windowToDisplayClass)
        console.log(this.displayButtons)
        console.log(this.windowsToDisplay)
        // for(const button of this.displayButtons) {
        //     button.addEventListener('click', () => {
        //         console.log('buttoon')
        //     })
        // }

        window.addEventListener('click', (event) => {
            for(let i = 0; i < this.displayButtons.length; i++) {
            console.log(this.windowsToDisplay[i])
                if (this.displayButtons[i].contains(event.target) || this.windowsToDisplay[i].contains(event.target)) {
                    console.log(this.windowsToDisplay[i])
                    // Clicked in buttonToDisplay
                    this.windowsToDisplay[i].classList.remove(unDisplayClass)
                    this.windowsToDisplay[i].classList.add(displayClass)
                    console.log('DISPLAY')
                } else {
                    // Clicked outside buttonToDisplay and window
                    console.log('UNDISPLAY')
                    this.windowsToDisplay[i].classList.remove(displayClass)  
                    this.windowsToDisplay[i].classList.add(unDisplayClass)
                }
            }
        })
    }
}
