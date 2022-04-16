
file = open("../py/node_pairs.txt","r")

wordlist = set()
currentStr = ""
for line in file.read():
    if line.strip() == "" or line.strip() == "\n":
        wordlist.add(currentStr)
        currentStr = ""
        continue
    currentStr += line

file.close()

my_newfile = open("../py/word_list.txt","w")

for word in sorted(list(wordlist)):
    my_newfile.write(word+'\n')

my_newfile.close()

print("end of write list")