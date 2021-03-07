import requests

# Test Case 1 -> customer login success
r = requests.post('http://localhost/project/try.php', data=dict(username='alvyn', password='randojm'))
print(r.status_code)
print(r.text)

# Test Case 2 -> customer login failed


# Test Case 3 -> customer signup success


# Test Case 4 -> customer signup failed


# email = ['1', '2']

# for e in email:
#     print(e)

# foreach $email as $e {
#   echo $e;
# }