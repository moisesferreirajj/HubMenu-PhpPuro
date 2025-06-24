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
            # Acessa a página de cadastro de produtos
            self.driver.findElement(By.ID, "category_page").click()

            time.sleep(3)
            open_form = self.driver.find_element(By.ID, "registerCat")
            open_form.click()
            time.sleep(3)

            # Procura pelos campos e envia os dados corretos
            # Nome do produto
            input_name = self.driver.find_element(By.ID, "categoriaNome")
            input_name.send_keys("Chinesa")
            time.sleep(3)



            submit_form = self.driver.find_element(By.ID, "regis_cat")
            submit_form.click()
        
            self.driver.findElement(By.ID, "category_page").click()
            time.sleep(3)
        except Exception as e:
            self.driver.quit()  

service = webdriver.Chrome()
addressUrl = service.get("http://localhost:8080/empresarial/dashboard/1")

testUnir = TestRegisterCategory(addressUrl, service)

testUnir.fill_product_form()