# POSTMORTEM

Les principaux problèmes rencontrés lors du développement sont :
- **Différences d'environnement** : Les commandes et installations varient entre Linux et Windows, ce qui nous a fait perdre du temps (beaucoup).
- **Divergences de conception** : Nous avons dû refactoriser certains contrôleurs à plusieurs reprises car notre visions initiale n'était pas la même.
- **Limitations logicielles** : Sur Windows, l'intégration de Symfony dans le terminal de VS Code a été capricieuse, à nécessité l'utilisation d'un terminal externe malgré plusieurs manipulations.