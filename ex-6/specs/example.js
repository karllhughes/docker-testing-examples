'use strict'

module.exports = {
  'sample test': function (browser) {
    browser
      .url(browser.launch_url)
    browser
      .waitForElementVisible('h1', 2000)
      .expect.element('h1')
      .text.to.equal("Nightwatch.js Test");
    browser
      .waitForElementVisible('#quote', 2000)
      .expect.element('#quote')
      .text.to.equal("'Programming' is a four-letter word.");
    browser
      .waitForElementVisible('#source', 2000)
      .expect.element('#source')
      .text.to.equal("Craig Bruce");
    browser.end();
  }
}
