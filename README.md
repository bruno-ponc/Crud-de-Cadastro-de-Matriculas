# Crud-de-Cadastro-de-Matriculas
Crud para cadastro de alunos, cursos e matriculas com armazenamento em banco MongoDB local.

# Sistema de Gestão Escolar – PHP + MongoDB

Mini Sistema de Cadastro de Estudantes, Cursos e Matrículas

Este projeto é um sistema completo para gerenciamento escolar utilizando **PHP**, **MongoDB**, **Bootstrap 5** e **Arquitetura Modular em Arquivos**.
O sistema demonstra conceitos de:

* Modelagem de Dados em MongoDB
* CRUD completo (Criar, Listar, Editar e Excluir)
* Relacionamentos via collections (Estudante ↔ Curso ↔ Matrícula)
* Interface moderna usando Bootstrap
* Organização modular de páginas

---

# Funcionalidades

## Cadastro de Estudantes

* Cadastro completo:

  * Nome, RG, CPF, data de nascimento
  * Telefones, filiação (pai/mãe)
  * Endereço completo (rua, nº, bairro, cidade, estado)
* Validação de campos obrigatórios.
* Interface moderna em card Bootstrap.
* Edição dos dados do estudante.
* Listagem com ações: **Editar / Excluir**.

---

## Cadastro de Cursos

* Cadastro de cursos com:

  * Nome
  * Código
  * Carga horária
  * Professor
  * Turno
* Listagem com tabela estilizada.
* Edição de cursos.
* Exclusão com:

  * **Modal de confirmação Bootstrap**
  * Botão estilizado

---

## Gestão de Matrículas

* Associação entre Estudante ↔ Curso.
* Seletores dinâmicos alimentados pelo banco.
* Edição das matrículas.
* Exclusão com **modal de confirmação**.
* Tela de listagem no formato:

  ```
  Nome do Aluno  —  Curso  —  Data da Matrícula
  ```
* Relacionamentos resolvidos com consultas cruzadas nas collections.

---

# Estrutura das Collections (MongoDB)

### **estudantes**

Armazena dados completos do aluno:

```
{
  _id,
  nome,
  rg,
  cpf,
  data_nascimento,
  telefones: [],
  filiacao: { mae, pai },
  endereco: { rua, numero, bairro, cidade, estado }
}
```

### **cursos**

```
{
  _id,
  nome,
  codigo,
  carga_horaria,
  professor,
  turno
}
```

### **matriculas**

```
{
  _id,
  id_estudante,
  id_curso,
  data_matricula
}
```

---

# Tecnologias Utilizadas

| Tecnologia                   | Uso no Projeto               |
| ---------------------------- | ---------------------------- |
| **PHP 8+**                   | Backend e lógica de CRUD     |
| **MongoDB (Driver Oficial)** | Banco NoSQL                  |
| **Bootstrap 5**              | Layout moderno e responsivo  |
| **HTML5/CSS3**               | Interface e estrutura visual |
| **JavaScript (mínimo)**      | Modais e interações          |

---

# Estrutura do Projeto

```
CadastroEstudante/
│── index.php
│── conexao.php
│── layout.php
│
│── cadastrar_estudante.php
│── listar_estudantes.php
│── editar_estudante.php
│
│── cadastrar_curso.php
│── listar_cursos.php
│── editar_curso.php
│
│── matricular.php
│── lista_matriculas.php
│── editar_matricula.php

```

---

# Como Executar o Projeto

## **1. Instale o MongoDB e ative o serviço**

* Windows/Mac/Linux
* Certifique-se de que o servidor está rodando em:

```
mongodb://localhost:27017
```

## **2. Ative a extensão mongodb no PHP**

No `php.ini`:

```
extension=php_mongodb.dll
```

## **3. Coloque o sistema no htdocs (XAMPP)**

```
C:\xampp\htdocs\CadastroEstudante\
```

## **4. Instale o driver via Composer (opcional)**

```
composer require mongodb/mongodb
```

## **5. Abra no navegador**

```
http://localhost/CadastroEstudante/
```

---

# Fluxo do Usuário

1. **Cadastrar Estudante**
2. **Cadastrar Curso**
3. **Realizar Matrícula**
4. **Listar / Editar / Excluir Matrículas**

---

# Relacionamentos

MongoDB não tem ER tradicional:

* **Estudante 1..N Matrículas**
* **Curso 1..N Matrículas**
* **Matrícula é uma associação Estudante ↔ Curso**
* Endereço é um subdocumento do Estudante

<img width="1536" height="1024" alt="diagrama" src="https://github.com/user-attachments/assets/cd0cc663-9177-4b31-9039-d48c9e91b880" />


---

# Exemplos Visuais (telas)

<img width="1919" height="942" alt="TelaInicial" src="https://github.com/user-attachments/assets/d4cbee16-d080-4126-b506-6cc88f9aceb4" />
<img width="1919" height="942" alt="CadastrarEstudante" src="https://github.com/user-attachments/assets/fff2ce9a-cd30-4a7d-953a-edb650978792" />
<img width="1919" height="945" alt="CadastrarCurso" src="https://github.com/user-attachments/assets/a6181ffc-c92e-4acd-a78c-21ba9ca3f8b5" />
<img width="1919" height="945" alt="RealizarMatricula" src="https://github.com/user-attachments/assets/b5127396-0331-457f-9b51-4d219d11539f" />


