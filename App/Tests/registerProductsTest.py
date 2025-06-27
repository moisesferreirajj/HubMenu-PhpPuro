from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time
import os


class TestRegisterProducts:
    def __init__(self, address, driver):
        self.address = address
        self.driver = driver
    
    def fill_product_form(self):
        # Acessa a página de login  
        self.driver.get(self.address)
        self.driver.maximize_window()
        
        try:
            print("Preenchendo email...")
            self.driver.find_element(By.ID, "email").send_keys("cautios2.0@gmail.com")
            self.driver.find_element(By.ID, "password").send_keys("yohan")
            time.sleep(3)

            print("Clicando em login...")
            self.driver.find_element(By.ID, "logar").click()
            time.sleep(10)


            print("Acessando página de produtos...")
            self.driver.find_element(By.ID, "products_page").click()
            time.sleep(3)

            print("Clicando em 'Novo Produto'...")
            self.driver.find_element(By.ID, "registerPro").click()
            time.sleep(3)

            print("Criando 'Novo Produto'...")
            name_input = self.driver.find_element(By.ID, "produtoNome")
            name_input.send_keys("Carbonara")
            
            time.sleep(2)
            
            category_select = Select(self.driver.find_element(By.ID, "produtoCategoria"))
            category_select.select_by_visible_text("Massas")
            
            time.sleep(2)
            
            price_input = self.driver.find_element(By.ID, "produtoPreco")
            price_input.send_keys("20.00")
            
            time.sleep(2)

            description_input = self.driver.find_element(By.ID, "produtoDescricao")
            description_input.send_keys("Deliciosa massa com molho cremoso de queijo e bacon.")

            time.sleep(2)

            print("Enviando imagem do produto...")
            img_path = os.path.abspath(os.path.join(os.path.dirname(__file__), "img", "Espaguetis_carbonara.png"))
            file_input = self.driver.find_element(By.ID, "produtoImagem")
            file_input.send_keys(img_path)
            time.sleep(2)

            status_select = Select(self.driver.find_element(By.ID, "produtoStatus"))
            status_select.select_by_value("1")  # 1 para Ativo, 0 para Inativo
            time.sleep(2)


            self.driver.find_element(By.ID, "regis_pro").click()

            self.driver.find_element(By.ID, "products_page").click()
            time.sleep(10)
        except Exception as e :
            print(f"Erro ao preencher o formulário: {e}")
            self.driver.quit()

service = webdriver.Chrome()
addressUrl = "http://10.3.76.83:8080/empresarial/login"  # Corrigido: agora é uma string

testUnir = TestRegisterProducts(addressUrl, service)

testUnir.fill_product_form()