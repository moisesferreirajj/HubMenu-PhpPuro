from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time

# Inicializa o driver do Chrome
driver = webdriver.Chrome()

# Abre o site do Google
driver.get("https://www.google.com")

# Aguarda 2 segundos para garantir que a página carregou
time.sleep(2)

# Localiza o campo de busca pelo nome e insere o texto "Selenium"
campo_busca = driver.find_element(By.NAME, "q")
campo_busca.send_keys("Selenium")
campo_busca.send_keys(Keys.RETURN)

# Aguarda 2 segundos para os resultados carregarem
time.sleep(2)

# Exibe o título da página
print("Título da página:", driver.title)

# Fecha o navegador
driver.quit()
