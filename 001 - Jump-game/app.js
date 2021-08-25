//character es nuestro personaje
document.addEventListener('DOMContentLoaded',() => {
    const character = document.querySelector('.character')
    const MAXIMUM_HEIGHT = 250
    const GRAVITY = 0.9
    const KEY_UP = 38
    const KEY_LEFT = 37
    const KEY_RIGHT = 39
    const KEY_DOWN = 40
    
    let timerLeft
    let timerRight
    let isGoingLeft = false
    let isGoingRight = false
    let isJumping = false

    let bottom = 0
    let left = 0

    function jump(){
        character.classList.add('character')
        character.classList.remove('character-sliding')

        if (isJumping) return

        isJumping=true

        let timerUp = setInterval(() =>{
            if (bottom >= MAXIMUM_HEIGHT){
                //detener salto
                clearInterval(timerUp)
                //hacer bajar el personaje

                let timerDown = setInterval(() => {    
                    if (bottom <= 0) {
                        clearInterval(timerDown)
                        isJumping = false
                    }KEY_RIGHT
                    bottom -=5
                    character.style.bottom = bottom + 'px'                            
                }, 20)
            }
            bottom += 30
            character.style.bottom = (bottom * GRAVITY) + 'px';
        }, 20)
    }

    function slideLeft(){
        character.classList.add('character-sliding')
        character.classList.remove('character')

        if (isGoingRight){
            console.log('Limpiando TimerRight')
            clearInterval(timerRight)
            isGoingRight = false
        }        
        if (isGoingLeft) return
        isGoingLeft = true
        timerLeft = setInterval(() => {
            left -= 5
            character.style.left = left + 'px'
        }, 20)
    }

    function slideRight(){
        character.classList.add('character-sliding')
        character.classList.remove('character')        

        if (isGoingLeft){
            console.log('Limpiando TimerLeft')
            clearInterval(timerLeft)
            isGoingLeft = false
        } 
        if (isGoingRight) return
        isGoingRight = true
        
        timerRight = setInterval(() => {
            left += 5
            character.style.left = left + 'px'
        }, 20)
    }

    function stand(){

        character.classList.add('character')
        character.classList.remove('character-sliding')   

        clearInterval(timerLeft)
        clearInterval(timerRight)

        isGoingRight =false
        isGoingLeft = false
        isJumping = false
    }


    document.addEventListener('keydown', (event) => {
        //console.log('aca!!')
        switch (event.keyCode){
            case KEY_UP:
                jump()
                break;
            case KEY_LEFT:
                slideLeft()
                break;
            case KEY_RIGHT:
                slideRight()                
                break;
            case KEY_DOWN:
                stand()               
                break;                
        }
    })
})