from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
import time


class TestRegisterProducts:
    def __init__(self, address, driver):
        self.address = address
        self.driver = driver
    
    def fill_product_form(self):
        try:
            # Acessa a página de cadastro de produtos
            self.driver.findElement(By.ID, "products_page").click()

            time.sleep(3)
            open_form = self.driver.find_element(By.ID, "registerPro")
            open_form.click()
            time.sleep(3)

            # Procura pelos campos e envia os dados corretos
            # Nome do produto
            input_name = self.driver.find_element(By.ID, "nome")
            input_name.send_keys("Carbonara")
            time.sleep(3)
            # Valor do produto
            input_valor = self.driver.find_element(By.ID, "valor")
            input_valor.send_keys("50")
            time.sleep(3)

            
            select_type = self.driver.find_element(By.ID, "categoria_id")
            dropdown = Select(select_type)
            time.sleep(3)
            dropdown.select_by_value("7")
            time.sleep(3)


            select_status = self.driver.find_element(By.ID, "status_produto")
            dropdown = Select(select_status)
            time.sleep(3)
            dropdown.select_by_value("1")
            time.sleep(3)



            input_descricao = self.driver.find_element(By.ID, "descricao")
            input_descricao.send_keys("Carbonara é um prato italiano feito com massa, ovos, queijo, guanciale e pimenta-do-reino. Cremoso e tradicional, vem de Roma.")
            time.sleep(2)

            
            # Imagem do produto
            input_img = self.driver.find_element(By.ID, "imagem")
            input_img.send_keys(r"/App/Tests/img")
            time.sleep(3)


            submit_form = self.driver.find_element(By.ID, "regis_pro")
            submit_form.click()
        except Exception as e:
            self.driver.quit()  

service = webdriver.Chrome()
addressUrl = service.get("http://localhost:8080/empresarial/dashboard/1")

testUnir = TestRegisterProducts(addressUrl, service)

testUnir.fill_product_form()