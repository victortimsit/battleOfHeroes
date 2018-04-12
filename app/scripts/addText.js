class AddText {
    constructor(parentClass, addTextareaButton, addTitleButton, crossDeleteButton) {
        this.parentClass = document.querySelector('.' + parentClass)
        this.addTextarea = document.querySelector('.' + addTextareaButton)
        this.addTitle = document.querySelector('.' + addTitleButton)
        /* this.deletes = document.querySelectorAll('.' + crossDeleteButton) */

        this.addTextarea.addEventListener('click', () => {
            this.createTextarea(this.parentClass)
        })
        this.addTitle.addEventListener('click', () => {
            this.createTitle(this.parentClass)
        })
        /* for(let i = 0; i < this.deletes.length; i++) {
            this.deletes[i].addEventListener('click', () => {
                deleteText(this.parentClass, i, deleteIcon)
            })
        } */
    }
    createTextarea(parent) {
        const label = document.createElement('label')
        parent.appendChild(label)
        label.classList.add('theoryCreation__addParagraph', 'theoryCreation__addParagraphLabel')
        label.setAttribute('for', 'paragraph')
        label.innerHTML ="Type your text"
        this.createCross(parent)
        const textarea = document.createElement('textarea')
        parent.appendChild(textarea)
        textarea.classList.add('theoryCreation__inputText')
        textarea.setAttribute('name', 'paragraph')
        textarea.setAttribute('placeholder', 'Add another argument to your theory')
    }
    createTitle(parent) {
        const label = document.createElement('label')
        label.classList.add('theoryCreation__addTitle', 'theoryCreation__addTitleLabel')
        label.setAttribute('for', 'title')
        label.innerHTML ="Title"
        this.createCross(parent)
        const title = document.createElement('input')
        parent.appendChild(label)
        parent.appendChild(title)
        title.classList.add('theoryCreation__input')
        title.setAttribute('name', 'title')
        title.setAttribute('placeholder', 'Type your new title')
    }
    createCross(parent) {
        const cross = document.createElement('span')
        parent.appendChild(cross)
        cross.classList.add('theoryCreation__deleteCross')
        const img = document.createElement('img')
        cross.appendChild(img)
        img.classList.add('theoryCreation__deleteCrossImg')
        img.setAttribute('src', '../assets/images/icons/cross.png')
    }
    /* deleteText(parent, i, deleteIcon) {
        const deletedTextareas = document.querySelectorAll('.theoryCreation__addParagraph')
        const deletedInput = document.querySelectorAll('.theoryCreation__inputText')
        parent.removeChild(deletedTextareas[i])
        parent.removeChild(deletedInput[i])
    } */
}

const test = new AddText('theoryCreation__addText', 'theoryCreation__addButtonParagraph', 'theoryCreation__addButtonTitle', 'theoryCreation__deleteCross')

