import { WebstorePage } from './app.po';

describe('webstore App', () => {
  let page: WebstorePage;

  beforeEach(() => {
    page = new WebstorePage();
  });

  it('should display welcome message', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('Welcome to app!');
  });
});
