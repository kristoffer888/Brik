 
a=1
for i in images/*.png; do
  new=$(printf "%d.png" "$a") #04 pad to length of 4
  mv -i -- "$i" "images/$new"
  let a=a+1
done
