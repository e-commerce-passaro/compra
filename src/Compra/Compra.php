<?php
namespace Ecompassaro\Compra;

use Ecompassaro\Produto\Produto;
use Ecompassaro\Autenticacao\Autenticacao;
use \DateTime;

class Compra
{
    const QUANTIDADE_DAFAULT = 1;
    const MOEDA_DEFAULT = 'BRL';
    const STATUS_INICIADA = 'iniciada';
    const STATUS_AGUARDANDO_PAGAMENTO = 'aguardando o pagamento';
    const STATUS_CONCLUIDA = 'concluida';
    const STATUS_CANCELADA = 'cancelada';

    private $id;

    private $produtoId;

    private $autenticacaoId;

    private $produto;

    private $autenticacao;

    private $data;

    private $quantidade = self::QUANTIDADE_DAFAULT;

    private $status;

    private $statusId;

    private $moeda = self::MOEDA_DEFAULT;

    public function getMoeda()
    {
      return $this->moeda;
    }

    public function setMoeda($moeda)
    {
      $this->moeda = $moeda;
      return $this;
    }

    /**
     *
     * @return int
     */
    public function getId()
    {
        return (int) $this->id;
    }

    /**
     *
     * @param int $id
     * @return Compra
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @return int
     */
    public function getProdutoId()
    {
        return (int) $this->produtoId;
    }

    /**
     *
     * @return int
     */
    public function getAutenticacaoId()
    {
        return (int) $this->autenticacaoId;
    }

    /**
     *
     * @return Produto
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     *
     * @return Autenticacao
     */
    public function getAutenticacao()
    {
        return $this->autenticacao;
    }

    /**
     *
     * @param int $produtoId
     * @return Compra
     */
    public function setProdutoId($produtoId)
    {
        $this->produtoId = $produtoId;
        return $this;
    }

    /**
     *
     * @param int $autenticacaoId
     * @return Compra
     */
    public function setAutenticacaoId($autenticacaoId)
    {
        $this->autenticacaoId = $autenticacaoId;
        return $this;
    }

    /**
     *
     * @param Produto $produto
     * @return Compra
     */
    public function setProduto($produto)
    {
        $this->produto = $produto;
        return $this;
    }

    /**
     *
     * @param Autenticacao $autenticacao
     * @return Compra
     */
    public function setAutenticacao($autenticacao)
    {
        $this->autenticacao = $autenticacao;
        return $this;
    }

    /**
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     *
     * @param \DateTime|string $data se string deve vir no formato Y-m-d H:i:s
     * @return Compra
     */
    public function setData($data)
    {
        if(!($data instanceof DateTime)) {
            $data = explode('.', $data)[0];
            $data = DateTime::createFromFormat('Y-m-d H:i:s', $data);
        }
        $this->data = $data;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantidade()
    {
        return (int) $this->quantidade;
    }

    /**
     * @param int $quantidade
     * @return Compra
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * @param int $statusId
     * @return Compra
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;
        return $this;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Status $status
     * @return Compra
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Obtem a estrutura da entity Compra em formato array
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'produto_id' => $this->produtoId,
            'autenticacao_id' => $this->autenticacaoId,
            'status_id' => $this->statusId,
            'quantidade' => $this->quantidade
            'moeda' => $this->moeda;
        );
    }

    public function getPreco()
    {
      if ($this->produto instanceof Produto) {
        return $this->quantidade * $this->produto->getPreco();
      }

      return 0;
    }

    /**
     * Preenche a entidade a partir de um array
     * @return Compra
     */
    public function exchangeArray($array)
    {
        return $this->setId(isset($array['id'])?$array['id']:null)
            ->setProdutoId($array['produto_id'])
            ->setStatusId(isset($array['status_id'])?$array['status_id']:null)
            ->setAutenticacaoId($array['autenticacao_id'])
            ->setData(isset($array['data'])?$array['data']:null)
            ->setQuantidade(isset($array['quantidade'])?$array['quantidade']:self::QUANTIDADE_DAFAULT);
            ->setMoeda(isset($array['moeda'])?$array['moeda']:self::MOEDA_DEFAULT);
    }
}
