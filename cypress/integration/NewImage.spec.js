it('NewImage', () => {
    cy.visit('http://localhost:3000');
    cy.get('.LoginForm input').should('have.length', 2).and('be.visible');
    cy.get('.LoginForm .loginFormSubmit').should('have.length', 1).and('be.visible');
    cy.get('.LoginForm [name=loginFormUsername]').should('have.length', 1).and('be.visible').type('zbynek.rybicka');
    cy.get('.LoginForm [name=loginFormPassword]').should('have.length', 1).and('be.visible').type('mojeMilaJulinka');
    cy.get('.LoginForm .loginFormSubmit').should('have.length', 1).and('be.visible').click();
    cy.get('.LoginForm').should('be.not.visible');
    cy.get('.Admin').should('have.length', 1).and('be.visible');
    cy.screenshot('afterLogin.png');
    cy.get('.PlusButton button').should('have.length', 1).and('be.visible').click();
    cy.get('.PlusImageUpload').should('have.length', 1).and('be.visible');
    cy.get('.PlusImageUrl input.category').should('have.length', 1).and('be.visible').type('podprsenky');
    cy.get('.PlusImageUrl input.url').should('have.length', 1).and('be.visible').type('https://www.triola.cz/8048-product_detail/Podprsenka-TRIOLA-28795.jpg');
    cy.get('.PlusImageUrl button.uploadImage').should('have.length', 1).and('be.visible').click();

});