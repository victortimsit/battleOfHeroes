class AddText {
    constructor(parentClass, addTextareaButton, addTitleButton, crossDeleteButton) {
        this.parentClass = document.querySelector('.' + parentClass)
        this.addTextarea = document.querySelector('.' + addTextareaButton)
        this.addTitle = document.querySelector('.' + addTitleButton)
        
        this.addTextarea.addEventListener('click', () => {
            this.createTextarea(this.parentClass)
            this.deletes = document.querySelectorAll('.' + crossDeleteButton)
        })
        this.addTitle.addEventListener('click', () => {
            this.createTitle(this.parentClass)
        })

        for(let i = 0; i < this.deletes.length; i++) {
            deleteIcons[i].addEventListener('click', () => {
                deleteText(this.parentClass, i, deleteIcon)
            })
        }

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
    deleteText(parent, i, deleteIcon) {
        const deletedTextareas = document.querySelectorAll('.theoryCreation__addParagraph')
        const deletedInput = document.querySelectorAll('.theoryCreation__inputText')
        parent.removeChild(deletedTextareas[i])
        parent.removeChild(deletedInput[i])
    }
}

const test = new AddText('content', 'textarea', 'title')