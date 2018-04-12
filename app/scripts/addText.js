class AddText {
    constructor(parentClass, addTextareaButton, addTitleButton) {
        this.parentClass = document.querySelector('.' + parentClass)
        this.addTextarea = document.querySelector('.' + addTextareaButton)
        this.addTitle = document.querySelector('.' + addTitleButton)

        this.addTextarea.addEventListener('click', () => {
            this.createTextarea(this.parentClass)
        })
        this.addTitle.addEventListener('click', () => {
            this.createTitle(this.parentClass)
        })
    }
    createTextarea(parent) {
        const textarea = document.createElement('textarea')
        parent.appendChild(textarea)
        textarea.classList.add('theoryCreation__inputText')
        textarea.setAttribute('name', 'paragraphe')
    }
    createTitle(parent) {
        const title = document.createElement('input')
        parent.appendChild(title)
        title.classList.add('theoryCreation__input')
        title.setAttribute('name', 'title')
    }
}

const test = new AddText('content', 'textarea', 'title')