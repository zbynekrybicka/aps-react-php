it('Wall', () => {
    cy.visit('http://localhost:3000');
    cy.get('.LoginForm input').should('have.length', 2).and('be.visible');
    cy.get('.LoginForm .loginFormSubmit').should('have.length', 1).and('be.visible');
    cy.get('.LoginForm [name=loginFormUsername]').should('have.length', 1).and('be.visible').type('zbynek.rybicka');
    cy.get('.LoginForm [name=loginFormPassword]').should('have.length', 1).and('be.visible').type('mojeMilaJulinka');
    cy.get('.LoginForm .loginFormSubmit').should('have.length', 1).and('be.visible').click();
    cy.get('.LoginForm').should('be.not.visible');
    cy.get('.Admin').should('have.length', 1).and('be.visible');
    cy.screenshot('afterLogin.png');
    cy.get('.WallImage img').should('have.length', 1).and('be.visible');
    cy.get('.WallNext button').should('have.length', 1).and('be.visible').click();
    cy.screenshot('wallImage.png');

});