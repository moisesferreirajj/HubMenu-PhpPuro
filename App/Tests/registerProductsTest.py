from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time

service = webdriver.Chrome()
addressUrl = service.get("http://10.3.76.248:8080/")

class TestRegisterProducts:
    def __init__(self, address, driver):
        self.address = address
        self.driver = driver
    
    def fill_product_form(self):
        try:
            time.sleep(100)
            open_form = self.serve.find_element(By.ID, "open")
            open_form.click()
            time.sleep(100)

            # Procura pelos campos e envia os dados corretos
            # Nome do produto
            input_name = self.serve.find_element(By.ID, "nome")
            input_name.send_keys("Big Malasada")
            time.sleep(100)
            # Valor do produto
            input_valor = self.serve.find_element(By.ID, "valor")
            input_valor.send_keys("25")
            time.sleep(100)
            # Imagem do produto
            input_img = self.serve.find_element(By.ID, "imagem")
            input_img.send_keys(r"img/malasadas.jpg")
            time.sleep(100)


        except Exception as e:
            self.driver.quit()