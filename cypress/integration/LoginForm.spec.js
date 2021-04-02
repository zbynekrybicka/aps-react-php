it('LoginForm', () => {
    cy.visit('http://localhost:3000');
    cy.get('.loginFormUsername').should('have.length', 1).and('be.visible').type('zbynek.rybicka');
    cy.get('.loginFormPassword').should('have.length', 1).and('be.visible').type('mojeMilaJulinka');
    cy.get('.loginFormSubmit').should('have.length', 1).and('be.visible').click();
    cy.get('.LoginForm').should('be.not.visible');
    cy.get('.Admin').should('have.length', 1).and('be.visible');
    cy.screenshot('LoginForm');

});