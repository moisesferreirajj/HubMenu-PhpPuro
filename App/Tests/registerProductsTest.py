from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time


class TestRegisterProducts:
    def __init__(self, address, driver):
        self.address = address
        self.driver = driver
    
    def fill_product_form(self):
        # Acessa a página de login  
        self.driver.get(self.address)
        self.driver.maximize_window()
        
        # Preenche e submete o login
        WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.ID, "email"))
        ).send_keys("cautios2.0@gmail.com")
        
        self.driver.find_element(By.ID, "password").send_keys("yohan")
        self.driver.find_element(By.ID, "logar").click()

        # Acessa a página de produtos
        WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.ID, "products_page"))
        ).click()
        
        # Abre o formulário de cadastro
        WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.ID, "registerPro"))
        ).click()

        # Preenche os campos do produto
        self.driver.find_element(By.ID, "nome").send_keys("Carbonara")
        self.driver.find_element(By.ID, "valor").send_keys("50")
        
        # Seleciona a categoria
        select_type = Select(self.driver.find_element(By.ID, "categoria_id"))
        select_type.select_by_visible_text("Massas")  # Ajuste conforme necessário

        # Submete o formulário (se houver botão de envio)
        self.driver.find_element(By.ID, "submit_button").click()

service = webdriver.Chrome()
addressUrl = "http://10.3.76.83:8080/empresarial/login"  # Corrigido: agora é uma string

testUnir = TestRegisterProducts(addressUrl, service)

testUnir.fill_product_form()