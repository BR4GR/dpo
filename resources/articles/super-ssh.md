# [Super SSH](https://play.picoctf.org/practice/challenge/424)

The goal is to connect to a remote server using **Secure Shell (SSH)** to retrieve the flag.

## Solution Steps

### 1. **Understand SSH**
SSH (Secure Shell) is a protocol for securely accessing and managing remote servers over an encrypted connection. It uses public-key cryptography to ensure secure communication and authentication. 

Key components:
- **Host:** The remote server you want to connect to.
- **Port:** The specific entry point on the server (default is port 22, but here it's port 58051).
- **Username and Password:** Credentials required to authenticate.


### 2. **Connect Using SSH**
Run the SSH command with the parts provided in the challenge to connect to the remote server in a command-line:

```bash
ssh -p 58051 ctf-player@titan.picoctf.net
```

### Explanation of the Command:
- `ssh`: The command to initiate an SSH connection.
- `-p 58051`: Specifies the port (default is 22, but the server uses port 58051).
- `ctf-player`: The username for the connection.
- `titan.picoctf.net`: The remote server's hostname.

### 3. **Accept the Host Fingerprint**
When connecting for the first time, SSH prompts to verify the server's **host key fingerprint**:
```plaintext
The authenticity of host '[titan.picoctf.net]:58051' can't be established.
ED25519 key fingerprint is SHA256:4S9EbTSSRZm32I+cdM5TyzthpQryv5kudRP9PIKT7XQ.
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes
```

- Type `yes` to accept the fingerprint and proceed.
- This step ensures that you're connecting to the correct server, and the host key is added to your local machine's `~/.ssh/known_hosts` file for future verification.

### 4. **Authenticate with the Password**
Once connected, the server prompts for the password, typing in a password in a comand line does not show the password:
```
ctf-player@titan.picoctf.net's password:
```
- Enter the password provided in the challenge (`84b12bae`) and press Enter.

### 5. **Retrieve the Flag**
After successfully logging in, the server outputs the flag:
```
Welcome ctf-player, here's your flag: picoCTF{s3cur3_c0nn3ct10n_07a987ac}
```
The connection then automatically closes.


Category: General Skills