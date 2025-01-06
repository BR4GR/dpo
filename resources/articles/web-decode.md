# [picoCTF Web Decode](https://play.picoctf.org/practice/challenge/427)

Start the instance.

Navigate to the Website.

With f12 or rightclick and Inspect open the Developer Tools.

in the source code of the about page you find a suspiciously long variable

```html
    <section class="about" notify_true="cGljb0NURnt3ZWJfc3VjYzNzc2Z1bGx5X2QzYzBkZWRfMTBmOTM3NmZ9">
```

could be base64 encoded, in the terminal you can decode it with:

```bash
    echo 'cGljb0NURnt3ZWJfc3VjYzNzc2Z1bGx5X2QzYzBkZWRfMTBmOTM3NmZ9' | base64 --decode
```

result:

```bash
    picoCTF{web_succ3ssfully_d3c0ded_10f9376f}%                                
```

Category: Web Exploitation