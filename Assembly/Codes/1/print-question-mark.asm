.model small
.stack 100h

.data
    char db '?'   ; character to display

.code
main:
    mov ax, @data
    mov ds, ax      ; initialize data segment

    mov ah, 02h     ; function to display a character
    mov dl, char    ; load '?' character into DL
    int 21h         ; DOS interrupt to print character

    mov ah, 4Ch     ; terminate program
    int 21h
end main
