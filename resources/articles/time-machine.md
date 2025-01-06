# [picoCTF TimeMachine](https://play.picoctf.org/practice/challenge/425)

The challenge is to retrieve a hidden flag from a project contained in a downloaded `.zip` file, which included a `.git` directory.

### 1. **Download and Extract the Challenge Files**

   - Created a directory to work in:
     ```bash
     mkdir time_machine
     cd time_machine
     ```
   - Downloaded the challenge file using `wget`:
     ```bash
     wget https://artifacts.picoctf.net/c_titan/160/challenge.zip
     ```
   - Unzipped the contents:
     ```bash
     unzip challenge.zip
     ```
     This revealed a directory named `drop-in`, containing a `.git` directory and other files.

### 2. **Explore the Git Repository**
   - Navigated into the `drop-in` directory:

     ```bash
     cd drop-in
     ```

   - Checked the Git log to view the commit history:
     ```bash
     git log
     ```
     The log revealed a commit with the flag embedded in the commit message.

     ```plaintext
     commit 89d296ef533525a1378529be66b22d6a2c01e530 (HEAD -> master)
     Author: picoCTF <ops@picoctf.com>
     Date:   Tue Mar 12 00:07:22 2024 +0000
     picoCTF{t1m3m@ch1n3_186cd7d7}
     ```


## Quick Overview: What is Git?

Git is a **distributed version control system** used to track changes in code or files. It allows multiple people to collaborate on a project, maintain a history of changes, and revert to previous versions when needed.

check [this](https://git-scm.com/book/en/v2) out, to find everythig you need to know about git.

### Key Features
1. **Version Control:**
   - Tracks every change made to files in a repository.
   - Enables reverting to earlier versions of code.

2. **Collaboration:**
   - Allows multiple contributors to work on the same project simultaneously.
   - Handles merging of changes from different contributors.

3. **Branching:**
   - Developers can create separate branches for features, fixes, or experiments without affecting the main project.

4. **Distributed System:**
   - Every developer has a full copy of the repository, including its history, on their machine.

### Common Commands
1. **Initialize a Repository:**
   ```bash
   git init
   ```
   Starts a new Git repository in the current directory.

2. **Clone a Repository:**
   ```bash
   git clone <url>
   ```
   Copies an existing repository to your local machine.

3. **Stage Changes:**
   ```bash
   git add <file>
   ```
   Prepares changes to be committed.

4. **Commit Changes:**
   ```bash
   git commit -m "Description of changes"
   ```
   Saves changes to the repository.

5. **Check History:**
   ```bash
   git log
   ```
   Shows a list of previous commits.

6. **Push Changes:**
   ```bash
   git push
   ```
   Uploads changes to a remote repository.

7. **Pull Updates:**
   ```bash
   git pull
   ```
   Downloads and merges changes from a remote repository.

### Why Use Git?
- Keeps track of all changes in a project.
- Facilitates teamwork by allowing distributed contributions.
- Helps manage and organize large projects efficiently.
- Provides safety through its ability to revert changes and review history.

Category: General Skills