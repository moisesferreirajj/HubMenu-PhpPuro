from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time
import os


class TestRegisterStores:
    def __init__(self, address, driver):
        self.address = address
        self.driver = driver
    
    def fill_store_form(self):
        # Acessa a página de login  
        self.driver.get(self.address)
        self.driver.maximize_window()
        
        try:
            print("Preenchendo email...")
            self.driver.find_element(By.ID, "email").send_keys("marciosenhorinha@gmail.com")
            self.driver.find_element(By.ID, "password").send_keys("marciosenhorinha")

            #18

            print("Clicando em login...")
            self.driver.find_element(By.ID, "logar").click()
            time.sleep(10)  

            gerenciar_url = "http://localhost:8080/gerenciar/estabelecimento/18"  # Ajuste o ID conforme necessário
            print(f"Acessando {gerenciar_url} ...")
            self.driver.get(gerenciar_url)
            time.sleep(5)

            # Preenchendo os campos de texto
            self.driver.find_element(By.ID, "nome").clear()
            self.driver.find_element(By.ID, "nome").send_keys("Senhorinha's Grill do Gaudério")
            time.sleep(3)

            self.driver.find_element(By.ID, "tipo").clear()
            self.driver.find_element(By.ID, "tipo").send_keys("Churrascaria")
            time.sleep(3)

            self.driver.find_element(By.ID, "cnpj").clear()
            self.driver.find_element(By.ID, "cnpj").send_keys("12.345.678/0001-99")
            time.sleep(3)

            self.driver.find_element(By.ID, "cep").clear()
            self.driver.find_element(By.ID, "cep").send_keys("12345-678")
            time.sleep(3)

            self.driver.find_element(By.ID, "endereco").clear()
            self.driver.find_element(By.ID, "endereco").send_keys("Rua do Senai Norte, Joinville SC")
            time.sleep(3)

            # Inputs de arquivo (imagem e banner)
            print("Enviando imagem do estabelecimento...")
            img_path = os.path.abspath(os.path.join(os.path.dirname(__file__), "img", "gauderiologo.png"))
            self.driver.find_element(By.ID, "imagem").send_keys(img_path)
            time.sleep(3)

            print("Enviando banner do estabelecimento...")
            banner_path = os.path.abspath(os.path.join(os.path.dirname(__file__), "img", "gauderio.png"))
            self.driver.find_element(By.ID, "banner").send_keys(banner_path)
            time.sleep(5)
            
            # BOTAO DE CORTAR BANNER APÓS 10 SEGUNDOS PARA EVITAR BUGS
            WebDriverWait(self.driver, 10).until(
                EC.element_to_be_clickable((By.ID, "cropBannerBtn"))
            ).click()
            time.sleep(3)
            
            #ENVIAR MUDANÇAS
            self.driver.find_element(By.ID, "saveChangesBtn").click()

        except Exception as e :
            print(f"Erro ao preencher o formulário: {e}")
            # self.driver.quit()

service = webdriver.Chrome()
addressUrl = "http://localhost:8080/empresarial/login"  # Corrigido: agora é uma string

testUnir = TestRegisterStores(addressUrl, service)

testUnir.fill_store_form()