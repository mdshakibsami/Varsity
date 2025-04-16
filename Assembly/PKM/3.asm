.model small
.stack 100h

.data
    sentence db "Enter a uppercase letter: $"

.code
main proc
    mov ax, @data
    mov ds, ax

    ; Display Msg
    mov ah, 9
    lea dx, sentence
    int 21h

    ; Read a character
    mov ah, 1
    int 21h
    mov bl, al 
               
    ; cret return and line break           
    mov ah, 2
    mov dl, 13     
    int 21h
    mov dl, 10     
    int 21h

    ; convert
    add bl, 20h

    ; Display Uppercase
    mov ah, 2
    mov dl, bl
    int 21h

    ; Exit
    mov ah, 4ch
    int 21h

main endp
end main
