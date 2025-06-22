from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
import time


user = {
    "name" : "Zoe Rotert",
    "cep" : 89120323,
    "endereco" : "Rua das Flores, 123",
    "email" : "zozo@mail.com",
    "telefone" : "1234567890",
    "password" : "zozo123",
}

ids_formulario = [
    "nome",
    "cep",
    "endereco",
    "email",
    "telefone",
    "senha",
]

key_id  = {
    "name": "nome",
    "endereco": "endereco",
    "email": "email",
    "telefone": "telefone",
    "password": "senha"
}

class TestRegisterUser:
    def __init__(self, address, driver):
        self.address = address
        self.driver = driver
    
    def fill_product_form(self):
        try:
            for key_user, id_form in key_id.items():
                time.sleep(5)
                element = self.driver.find_element(By.ID, id_form)
                element.send_keys(user[key_user])

            time.sleep(5)
            confirm = self.driver.find_element(By.ID, "confirmar-senha")
            confirm.send_keys(user["password"])

            time.sleep(5)
            checkbox = self.driver.find_element(By.ID, "aceito_termos")
            checkbox.click()

            time.sleep(8)
            submit_button = self.driver.find_element(By.ID, "btn-cadastrar")
            submit_button.click()
        except Exception as e:
            self.driver.quit()  

service = webdriver.Chrome()
addressUrl = service.get("http://localhost:8080/empresarial/cadastro")

testUnir = TestRegisterUser(addressUrl, service)

testUnir.fill_product_form()