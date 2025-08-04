.model small
.stack 100h

.code
main:
    mov ah, 02h     ; Function to display a character
    mov dl, 3Fh     ; ASCII code of '?' is 63 decimal = 3Fh hex
    int 21h         ; DOS interrupt to display the character

    mov ah, 4Ch     ; Terminate program
    int 21h
end main
