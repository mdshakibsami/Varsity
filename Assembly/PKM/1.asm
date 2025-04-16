.model small
.stack 100h

.data
    sentence db "This is a message.$"

.code
main proc
    mov ax, @data
    mov ds, ax

    ; Display Msg
    mov ah, 9
    lea dx, sentence
    int 21h


    ; Exit
    mov ah, 4ch
    int 21h

main endp
end main
