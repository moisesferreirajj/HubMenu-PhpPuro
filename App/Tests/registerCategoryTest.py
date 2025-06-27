from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
import time


class TestRegisterCategory:
    def __init__(self, address, driver):
        self.address = address
        self.driver = driver
    
    def fill_category_form(self):
        try:
            print("Preenchendo email...")
            self.driver.find_element(By.ID, "email").send_keys("cautios2.0@gmail.com")
            self.driver.find_element(By.ID, "password").send_keys("yohan")
            time.sleep(3)

            print("Clicando em login...")
            self.driver.find_element(By.ID, "logar").click()
            time.sleep(10)

            print("Acessando página de categoria...")
            self.driver.find_element(By.ID, "category_page").click()
            time.sleep(3)

            print("Procurando botão de cadastro de categoria...")
            open_form = self.driver.find_element(By.ID, "registerCat")
            print("Botão encontrado:", open_form)
            open_form.click()
            time.sleep(3)

            print("Preenchendo nome da categoria...")
            input_name = self.driver.find_element(By.ID, "categoriaNome")
            input_name.send_keys("Chinesa")
            time.sleep(3)

            print("Enviando formulário...")
            submit_form = self.driver.find_element(By.ID, "regis_cat")
            submit_form.click()
        
            self.driver.find_element(By.ID, "category_page").click()
            time.sleep(3)

            
            self.driver.find_element(By.ID, "category_page").click()
            time.sleep(10)
        except Exception as e:
            print("Erro:", e)
            self.driver.quit()
driver = webdriver.Chrome()
driver.maximize_window()
addressUrl = "http://localhost:8080/empresarial/login"
driver.get(addressUrl)

testUnir = TestRegisterCategory(addressUrl, driver)

testUnir.fill_category_form()