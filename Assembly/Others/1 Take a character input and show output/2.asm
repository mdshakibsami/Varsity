.model small
.stack 256
.code

main proc
    ; take a char input
    mov ah,01h
    int 21h
    mov bl,al
    
    ;show output 
    mov ah,02h     
    mov dl,bl
    int 21h 
    
    ;terminate the program (return 0)
    exit:
    mov ah,4ch
    int 21h
    main endp
end main
    
; Some important notes
; register =  high-portion, low-portion 
; ax = ah, al ===> al for taking inputs
; bx = bh, bl 
; cx = ch, cl
; dx = dh, dl ===> dl for showing output
; we'll use the registers based on data size
; bx and cx are temporary storage
; we'll use low portion then high portion if we needed for bx and cx