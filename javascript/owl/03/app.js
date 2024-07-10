const { Component, mount, xml } = owl;

// Owl Components
class Root extends Component {
  static template = "Hello";
}

async function owlSetup() {
    const xml = await fetch('app.xml');
    mount(Root, document.body, { templates: await xml.text(), dev: true });
}

owlSetup();
