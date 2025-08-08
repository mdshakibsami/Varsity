.model small        ; Define memory model as 'small' (64KB code, 64KB data)
.stack 100h        ; Set stack size to 256 bytes, you can use 256 instead of 100h

.code              ; Start of the code segment
main proc          ; Define the main procedure

    ; ==============================
    ; Step 1: Take a Single Character Input
    ; ==============================
    mov ah,1       ; DOS interrupt function 01h (you can use 01h instead of 1): Input a single character
    int 21h        ; Call DOS interrupt 21h, result is stored in AL
    mov bl,al      ; Store the input character from AL to BL for later use

    ; ==============================
    ; Step 2: Display the Character as Output
    ; ==============================
    mov ah,2       ; DOS interrupt function 02h (you can use 02h instead of 2): Display a character
    mov dl,bl      ; Move the stored input character from BL to DL (output register)
    int 21h        ; Call DOS interrupt 21h to print the character

    ; ==============================
    ; Step 3: Exit the Program
    ; ==============================
exit:
    mov ah,4Ch     ; DOS interrupt function 4Ch: Exit program
    int 21h        ; Call DOS interrupt 21h to terminate the program

main endp          ; End of the main procedure
end main           ; Mark the end of the program, execution starts from 'main'
