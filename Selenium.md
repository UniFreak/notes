# See
- <https://selenium-python.readthedocs.io/>
- <https://www.selenium.dev/documentation>

# Concept

Selenium: toolset for web browser automation that uses the best techniques available to remotely control browser instances and emulate a user’s interaction with the browser.

WebDriver: an API and protocol that defines a language-neutral interface for controlling the behaviour of web browsers. Each browser is backed by a specific WebDriver implementation, called a driver. The driver is the component responsible for delegating down to the browser, and handles communication to and from Selenium and the browser.

IDE: tool you use to develop your Selenium test cases.

Grid: allows you to run test cases in different machines across different platforms.

Selenium can be extended through the use of plugins.

# Install

Install the Selenium bindings for your automation project:

For Python: `pip install selenium`

--- 

Install Chrome WebDriver binaries: 

Most drivers require an extra executable for Selenium to communicate with the browser.

Download the WebDriver binary at <https://sites.google.com/a/chromium.org/chromedriver/downloads>
and place it in the System PATH.

---

If you plan to use Grid then you should download the selenium-server-standalone JAR file

--- 

Direct communication:

WebDriver: Bindings + support classes <===> Driver (ChromeDriver eg.) <===> Browser

Remote communication:

WebDriver <===> [ Remote WebDriver <==> Driver <==> Browser ] <- Host System

WebDriver <===> Selenium Server or Grid [ Driver <==> Browser ]



# Getting Start

Finding Elements

single: 

    driver.find_element(By.ID, "cheese")

multi: 

    driver.find_elements_by_css_selector("#cheese li")

relative: 

    passwordField = driver.find_element(By.ID, "password")
    emailAddressField = driver.find_element(with_tag_name("input").above(passwordField))
    // other: below(), toLeftOf(), toRightOf(), near(), 

# Web Driver

## Browser Manipulation

driver.get("https://selenium.dev")
driver.current_url
driver.forward()
driver.refresh()
driver.title

### Window & Tab

driver.current_window_handle

```python
from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

# Start the driver
with webdriver.Firefox() as driver:
    # Open URL
    driver.get("https://seleniumhq.github.io")

    # Setup wait for later
    wait = WebDriverWait(driver, 10)

    # Store the ID of the original window
    original_window = driver.current_window_handle

    # Check we don't have other windows open already
    assert len(driver.window_handles) == 1

    # Click the link which opens in a new window
    driver.find_element(By.LINK_TEXT, "new window").click()

    # Wait for the new window or tab
    wait.until(EC.number_of_windows_to_be(2))

    # Loop through until we find a new window handle
    for window_handle in driver.window_handles:
        if window_handle != original_window:
            driver.switch_to.window(window_handle)
            break

    # Wait for the new tab to finish loading content
    wait.until(EC.title_is("SeleniumHQ Browser Automation"))
```


driver.switch_to.new_window('tab')
driver.switch_to.new_window('window')

driver.close()
driver.switch_to.window(original_window)

driver.quit()

### Frame & Iframe

use WebElement

```python
# Store iframe web element
iframe = driver.find_element(By.CSS_SELECTOR, "#modal > iframe")

# switch to selected iframe
driver.switch_to.frame(iframe)

# Now click on button
driver.find_element(By.TAG_NAME, 'button').click()
```

by id

```python
driver.switch_to.frame('buttonframe')
```

use index

```python
driver.switch_to.frame(1)
```

### Window Management


driver.get_window_size().get("width")
driver.get_window_size().get("height")
driver.set_window_size(1024, 768)

driver.get_window_position().get('x')
driver.get_window_position().get('y')
driver.set_window_position(0, 0)
  
driver.maximize_window()
driver.minimize_window()
driver.fullscreen_window()

driver.save_screenshot('./image.png')

ele = driver.find_element(By.CSS_SELECTOR, 'h1')
ele.screenshot('./image.png')

driver.print_page(print_options)

## Waits

Explicit waits are available to Selenium clients for imperative, procedural languages. They allow your code to halt program execution, or freeze the thread, until the condition you pass it resolves. 

```python
driver.navigate("file:///race_condition.html")
el = WebDriverWait(driver).until(lambda d: d.find_element_by_tag_name("p"))
```


By implicitly waiting, WebDriver polls the DOM for a certain duration when trying to find any element. This can be useful when certain elements on the webpage are not available immediately and need some time to load.

```python
driver.implicitly_wait(10)
```

Warning: Do not mix implicit and explicit waits.

FluentWait instance defines the maximum amount of time to wait for a condition, as well as the frequency with which to check the condition.

```python
driver = Firefox()
driver.get("http://somedomain/url_that_delays_loading")
wait = WebDriverWait(driver, 10, poll_frequency=1, ignored_exceptions=[ElementNotVisibleException, ElementNotSelectableException])
element = wait.until(EC.element_to_be_clickable((By.XPATH, "//div")))
```


## Web Element

WebElement represents a DOM element. 

text
rect
tag_name
get_attribute("title")
send_keys("webElement")
is_enabled()
is_selected()
value_of_css_property('color')

## Keyboard

Available keyboard: <https://www.w3.org/TR/webdriver/#keyboard-actions>

send_keys("webdriver" + Keys.ENTER)
webdriver.ActionChains(driver).key_down(Keys.CONTROL).send_keys("a").perform()

```python
action = webdriver.ActionChains(driver)

# Enters text "qwerty" with keyDown SHIFT key and after keyUp SHIFT key (QWERTYqwerty)

action.key_down(Keys.SHIFT).send_keys_to_element(search, "qwerty").key_up(Keys.SHIFT).send_keys("qwerty").perform()
```

clear()

## Cookie

driver.add_cookie({"name": "key", "value": "value"})
driver.get_cookie("foo")
driver.get_cookies()
driver.delete_cookie("test1")
driver.delete_all_cookies()

