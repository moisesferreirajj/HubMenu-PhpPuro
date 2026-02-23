from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
import time


user = {
    "name": "Zoe Rotert",
    "email": "zozo@gmail.com",
    "telefone": "0987654321",
    "password": "Ana&Jordan321",
    "cep": "12345678",
    "endereco": "Rua Exemplo, 456"
}

ids_formulario = [
    "usuarioNome",
    "usuarioEmail",
    "usuarioTelefone",
    "usuarioSenha",
    "usuarioCep",
    "usuarioEndereco"
]

key_id = {
    "name": "usuarioNome",
    "email": "usuarioEmail",
    "telefone": "usuarioTelefone",
    "password": "usuarioSenha",
    "cep": "usuarioCep",
    "endereco": "usuarioEndereco"
}


class TestRegisterUser:
    def __init__(self, address, driver):
        self.address = address
        self.driver = driver
    
    def fill_user_form(self):
        try:
            # Processo de login
            print("Preenchendo email...")
            self.driver.find_element(By.ID, "email").send_keys("cautios2.0@gmail.com")
            self.driver.find_element(By.ID, "password").send_keys("yohan")
            time.sleep(3)

            print("Clicando em login...")
            self.driver.find_element(By.ID, "logar").click()
            time.sleep(10)

            print("Acessando página de usuários...")
            self.driver.find_element(By.ID, "user_page").click()
            time.sleep(3)
            
            self.driver.find_element(By.ID, "btnNovoUsuario").click()
            time.sleep(3)
            for key_user, id_form in key_id.items():
                time.sleep(3)
                element = self.driver.find_element(By.ID, id_form)
                element.send_keys(user[key_user])

            time.sleep(3)
            confirm = self.driver.find_element(By.ID, "usuarioSenha2")
            confirm.send_keys(user["password"])

            select_role = self.driver.find_element(By.ID, "usuarioCargo")
            dropdown = Select(select_role)
            time.sleep(3)
            dropdown.select_by_value("3")
            time.sleep(3)

            time.sleep(5)
            submit_button = self.driver.find_element(By.ID, "regis_usu")
            submit_button.click()
            time.sleep(10)
            self.driver.find_element(By.ID, "user_page").click()
            time.sleep(3)

        except Exception as e:
            print("Erro:", e)
            self.driver.quit()  

service = webdriver.Chrome()
service.maximize_window()
addressUrl = service.get("http://localhost:8080/empresarial/login")

testUnir = TestRegisterUser(addressUrl, service)

testUnir.fill_user_form()