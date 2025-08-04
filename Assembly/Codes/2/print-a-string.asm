.model small
.stack 100h

.data
    msg  db 'Hello, 8086!', '$'    ; '$' marks the end of string for int 21h/09h

.code
    main:
         mov ax, @data
         mov ds, ax       ; initialize DS with data segment

         mov ah, 09h      ; function to display a string
         lea dx, msg      ; load address of string into DX
         int 21h          ; DOS interrupt to print string

         mov ah, 4Ch      ; terminate program
         int 21h
end main
