.model small
.stack 100h

.data
    msg db 'Sum = $'

.code
main:
    mov ax, @data
    mov ds, ax

    ; Print "Sum = "
    mov ah, 09h
    lea dx, msg
    int 21h

    ; Compute 1 + 2 + 3 + 4 = 10
    mov ax, 1
    add ax, 2
    add ax, 3
    add ax, 4       ; AX = 10

    ; Convert AX to decimal digits
    mov bx, 10
    xor dx, dx       ; Clear DX for division
    div bx           ; AX / 10 → Quotient in AL, Remainder in DL

    mov bl, al       ; BL = quotient (tens)
    mov bh, dl       ; BH = remainder (ones)

    ; Print tens digit
    add bl, '0'
    mov dl, bl
    mov ah, 02h
    int 21h

    ; Print ones digit
    add bh, '0'
    mov dl, bh
    mov ah, 02h
    int 21h

    ; Exit
    mov ah, 4Ch
    int 21h
end main
