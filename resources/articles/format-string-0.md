# [picoCTF format string 0](https://play.picoctf.org/practice/challenge/433)

1. **Understand the Goal:**
   - The flag is stored in a global variable `flag` and printed by the `sigsegv_handler()` function when a segmentation fault (SIGSEGV) occurs.

2. **Phase 1: Serve Patrick**
   - Input a valid burger name from the menu (`Breakf@st_Burger`, `Gr%114d_Cheese`, or `Bac0n_D3luxe`) it needs to be long enough so that when `printf(choice1)` is called, it prints more than 64 characters (`2 * BUFSIZE`), advancing the program to the next phase.
   - input:

     ```
     Gr%114d_Cheese
     ```

    - %d tells printf() to expect an integer from the arguments provided to it and print it as a decimal number. 114 is a width specifier. It instructs printf() to print the integer with a minimum field width of 114 characters. If the number is shorter than 114 characters, it will be padded with spaces on the left.

   - output:

     ```
     Gr                                                                                                           4202954_Cheese
     ```

3. **Phase 2: Serve Sponge Bob**
   - Input a string containing enough format specifiers (e.g., `%s`, `%p`) to exploit the format string vulnerability in:

     ```c
     printf(choice2);
     ```

   - This causes the program to attempt invalid memory access, resulting in a segmentation fault.
   - input:

     ```
     Cla%sic_Che%s%steak
     ```

   - The segmentation fault triggers the custom `sigsegv_handler()` function, which prints the flag from memory.

   - The program outputs the flag:

     ```
     picoCTF{7h3_cu570m3r_15_n3v3r_SEGFAULT_63191ce6}
     ```

Category: Binary Exploitation