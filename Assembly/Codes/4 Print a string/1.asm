.model small
.stack 100h

.data
    sentence db "This is a sentence $"

.code
main proc
    ;data segment initialization
         mov ax, @data
         mov ds,ax
    
    ;show string
         mov ah,9           ; For string output
         lea dx,sentence    ; lea => Load Effective Address
         int 21h
    
    ;exit
    exit:
main endp
end main
    

;Note:
;   LEA                 Loads the address of the operand.                              
;   MOV                 Loads the value at the address.