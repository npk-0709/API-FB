import requests

#config
cookie='' # your cookie facebook
access_token='' # your access_token
useragent='' # your useragent 

host=['https://khuong.xyz','http://phukhuong.000webhostapp.com'] # my host 
host=host[1]
#host=host[2]


#reactions

id_reactions=''#id you need reactions post
type=['HAHA','WOW','SAD','LOVE'] # type reactions
data={"ID":id,"TYPE":type,"COOKIE":cookie,"USERAGENT":useragent}
file=requests.post(host+'/API/reactions.php',data=data)
print(file.text)

# comment post

msg='' #Message
id_cmt='' #id you need comment post
data={"ACCESS_TOKEN":access_token,"ID":id_cmt,"MSG":msg,"COOKIE":cookie,"USERAGENT":useragent}
file=requests.post(host+'/API/comment.php',data=data)
print(file.text)

#like post

id_like='' #id you need like post
data={"ACCESS_TOKEN":access_token,"ID":id_like,"COOKIE":cookie,"USERAGENT":useragent}
file=requests.post(host+'/API/like.php',data=data)
print(file.text)

#like page

id_page='' #id fanpage
data={"ID":id_page,"COOKIE":cookie,"USERAGENT":useragent}
file=requests.post(host+'/API/like-page.php',data=data)
print(file.text)

#follow

id_follow='' # id you need follow 
data={"ACCESS_TOKEN":access_token,"ID":id_follow,"COOKIE":cookie,"USERAGENT":useragent}
file=requests.post(host+'/API/follow.php',data=data)
print(file.text)
