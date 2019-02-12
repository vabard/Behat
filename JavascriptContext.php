  <?php

use Behat\Behat\Context\SnippetAcceptingContext;
use \Drupal\DrupalExtension\Context\RawDrupalContext;

/**
 * Defines application features from the javscript context.
 */
class JavascriptContext extends RawDrupalContext implements SnippetAcceptingContext {
  
  /**
   * Checks, that the maximum length of the CSS element is (?P<num>\d+).
   * Example: Then The ".title" element has a max length 10
   * Example: And The ".description" element has a max length 70
   *
   * @Then /^The "([^"]*)" element has a max length (?P<num>\d+)$/
   */
  public function elementHasMaxLength($element, $length) {
    $page = $this->getSession()->getPage();
    $findName = $page->find("css", $element);

    if (!$findName) {
      throw new Exception($element . " could not be found");
    } elseif (strlen($findName->getText()) > $length) {
      throw new \ErrorException(sprintf(
        'The element\' length is greater than %d. Its length is %d',
        $length,
        strlen($findName->getText())
      ));
    }
  }
}
