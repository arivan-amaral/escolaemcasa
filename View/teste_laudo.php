<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Upload PDF por Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h4>Lista de Registros</h4>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>101</td>
        <td>Cliente A</td>
        <td><button class="btn btn-primary btn-enviar" data-id="101" data-nome="Cliente A">Enviar PDF</button></td>
      </tr>
      <tr>
        <td>102</td>
        <td>Cliente B</td>
        <td><button class="btn btn-primary btn-enviar" data-id="102" data-nome="Cliente B">Enviar PDF</button></td>
      </tr>
      <!-- Mais linhas aqui -->
    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formUpload" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Aluno:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <p id="nome_destinatario" class="fw-bold text-primary"></p> <!-- Nome do destinatário -->
        <input type="file" name="arquivo_pdf" id="arquivo_pdf" accept="application/pdf" class="form-control mb-2" required>
        <input type="hidden" id="id_registro" name="id_registro">
        <div id="mensagem" class="text-center text-info small"></div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Enviar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Função para abrir o modal com os dados do cliente
  document.querySelectorAll('.btn-enviar').forEach(botao => {
    botao.addEventListener('click', function () {
      const id = this.getAttribute('data-id');
      const nome = this.getAttribute('data-nome');

      document.getElementById('id_registro').value = id;
      document.getElementById('arquivo_pdf').value = '';
      document.getElementById('mensagem').textContent = '';
      document.getElementById('nome_destinatario').textContent = `Enviando PDF para: ${nome}`;

      // Atualiza o título da aba do navegador
      document.title = `Aluno: ${nome}`;

      // Abre o modal
      const modal = new bootstrap.Modal(document.getElementById('uploadModal'));
      modal.show();
    });
  });

  // Restaura o título original ao fechar o modal
  document.getElementById('uploadModal').addEventListener('hidden.bs.modal', function () {
    document.title = 'Upload PDF por Registro';
  });

  // Envia o formulário via AJAX
  document.getElementById('formUpload').addEventListener('submit', async function (e) {
    e.preventDefault();

    const arquivo = document.getElementById('arquivo_pdf').files[0];
    const id = document.getElementById('id_registro').value;
    const mensagem = document.getElementById('mensagem');

    if (!arquivo) {
      mensagem.textContent = 'Selecione um PDF.';
      return;
    }

    const formData = new FormData();
    formData.append('arquivo_pdf', arquivo);
    formData.append('id_registro', id);

    mensagem.textContent = 'Enviando...';

    try {
      const response = await fetch('teste_laudo_upload.php', {
        method: 'POST',
        body: formData
      });

      const texto = await response.text();
      mensagem.textContent = texto;

      // Fechar o modal após o envio bem-sucedido
           const modal = bootstrap.Modal.getInstance(document.getElementById('uploadModal'));
           modal.hide();
    } catch (error) {
      mensagem.textContent = 'Erro ao enviar o arquivo.';
    }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
