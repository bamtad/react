from faker import Faker
import random
import string
# Create a Faker instance
fake = Faker()
f=open("fake_user.pgsql","w")

# Generate 100 random names
for i in range(300):
    name = fake.name()
    email=fake.email()
    phone=fake.phone_number()
    date="2022-04-05"
    password = ''.join(random.choices(string.ascii_letters + string.digits, k=10))
    url = ''.join(random.choices(string.ascii_letters + string.digits, k=10))
    sql = f"INSERT INTO \"user\" (\"fname\", \"email\", \"password\",\"phone\",\"updated_at\",\"created_at\") VALUES ('{name}', '{email}', '{password}','{phone}','{date}','{date}');"   
    f.write(sql)
f.close()