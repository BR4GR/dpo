# [picoCTF interencdec](https://play.picoctf.org/practice/challenge/418?category=2&page=1)

the downloaded file contains an encoded string:

```plaintext
YidkM0JxZGtwQlRYdHFhR3g2YUhsZmF6TnFlVGwzWVROclgyMHdNakV5TnpVNGZRPT0nCg
```

in the terminal we can pipe tat directly into base 64 decode with:

```bash
cat enc_flag | base64 --decode
```

which returns  base 64 encoded bytes:

```plaintext
b'd3BqdkpBTXtqaGx6aHlfazNqeTl3YTNrX20wMjEyNzU4fQ=='
```

decode it again with:

```bash
echo "d3BqdkpBTXtqaGx6aHlfazNqeTl3YTNrX20wMjEyNzU4fQ==" | base64 --decode
```

which gives us:

```plaintext
wpjvJAM{jhlzhy_k3jy9wa3k_m0212758}
```

this looks like a caesar cypher, we know the first character must be a p so we use caesar 19:

```bash
echo "wpjvJAM{jhlzhy_k3jy9wa3k_m0212758}" | caesar 19
```
result:

```plaintext
picoCTF{caesar_d3cr9pt3d_f0212758}
```