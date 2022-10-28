{*INCLUDE FUNCAO BANNER*}
{include file="breadcrumbs.tpl"}

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
                    <h5>Opções</h5>
                </div>
                <div class="widget-content"> 
                    <ul style="margin: 0 0 0 0 !important;">
                        <li style="margin-left: auto; margin-bottom: 4px; list-style-type: none;">
                            <button type="button" class="btn btn-outline-secondary" style="width: 100%;"> Dados Gerais </button> 
                        </li>
                        <li style="margin-left: auto; margin-bottom: 4px; list-style-type: none;">
                            <button type="button" class="btn btn-outline-secondary" style="width: 100%;"> Opções SkyHub </button> 
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="span9">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Detalhes do produto ID-CRONUS: <strong style="color: red;">{$PRODUTO.p_id}</strong> | ID-ERP: <strong style="color: red;">{$PRODUTO.id_item_externo}</strong> | SKU-SKYHUB: <strong style="color: red;">{$PRODUTO.isbn}</strong></h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="{$PAGINA_ACTION_PRODUTO}">
                        <input type="hidden" value="{$PRODUTO.p_id}" id="p_id" name="p_id">
                        <input type="hidden" value="dadosGerais" id="action" name="action">
                        <div class="control-group">
                            <label class="control-label">Título</label>
                            <div class="controls">
                                <input type="text" placeholder="Título" value="{$PRODUTO.titulo}" class="span11 tip" data-original-title="" id="titulo" name="titulo" required="">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Marca | Editora</label>
                            <div class="controls">
                                <select id="editora" name="editora" required="">
                                    {foreach from=$EDITORAS item=E}
                                        <option  value="{$E.id_editora}" {if $PRODUTO.id_editora == $E.id_editora}selected=""{/if}>{$E.nome}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Autor</label>
                            <div class="controls">
                                <select id="autor" name="autor">
                                    {foreach from=$AUTORES item=A}
                                        <option value="{$A.id_autor}" {if $PRODUTO.id_autor == $A.id_autor}selected=""{/if} >{$A.nome_autor}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">ISBN</label>
                            <div class="controls">
                                <div class="input-prepend"> 
                                    <input type="text" placeholder="ISBN" value="{$PRODUTO.isbn}" class="span11" id="isbn" name="isbn" disabled="">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Categoria</label>
                            <div class="controls">
                                <select id="categoria" name="categoria" required="">
                                    {foreach from=$CATEGORIAS item=C}
                                        <option value="{$C.id_cat}" {if $PRODUTO.id_cat == $C.id_cat}selected=""{/if} >{$C.nome}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Tipo de Produto</label>
                            <div class="controls">
                                <select id="tipoProduto" name="tipoProduto" required="">
                                    {foreach from=$TIPOSPRODUTO item=TP}
                                        <option value="{$TP.id_tipo_produto}" {if $PRODUTO.id_tipo_produto == $TP.id_tipo_produto}selected=""{/if} >{$TP.nome}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Peso</label>
                            <div class="controls">
                                <div class="input-prepend"> 
                                    <span class="add-on">g</span>
                                    <input type="text" placeholder="Peso" value="{$PRODUTO.peso}" class="span8 gramas" id="peso" name="peso" required="">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Altura  </label>
                            <div class="controls">
                                <div class="input-prepend"> 
                                    <span class="add-on">cm</span>
                                    <input type="text" placeholder="Altura" value="{$ALTURA}" class="span8 centimetro" id="altura" name="altura" required="">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Largura </label>
                            <div class="controls">
                                <div class="input-prepend"> 
                                    <span class="add-on">cm</span>
                                    <input type="text" placeholder="Largura" value="{$LARGURA}" class="span8 centimetro" id="largura" name="largura" required="">
                                </div>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label">Comprimento </label>
                            <div class="controls">
                                <div class="input-prepend"> 
                                    <span class="add-on">cm</span>
                                    <input type="text" placeholder="Comprimento" value="{$COMPRIMENTO}" class="span8 centimetro" id="comprimento" name="comprimento" required="">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Preço de Capa </label>
                            <div class="controls">
                                <div class="input-prepend"> 
                                    <span class="add-on">R$</span>
                                    <input type="text" placeholder="Preço Cheio" value="{$PRODUTO.precoCheio}" class="span8 money" id="precoCapa" name="precoCapa" required="">

                                </div>
                            </div>
                        </div>



                        <div class="control-group">
                            <label class="control-label">Preço Promoção</label>
                            <div class="controls">
                                <div class="input-prepend"> 
                                    <span class="add-on">R$</span>
                                    <input type="text" placeholder="Preço Promocional" value="{$PRODUTO.precoPromo}" class="span8 money" id="precoPromo" name="precoPromo">
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Custo </label>
                            <div class="controls">
                                <div class="input-prepend"> 
                                    <span class="add-on">R$</span>
                                    <input type="text" style="color: red" placeholder="Preço Cheio" value="{$PRODUTO.custoAtual}" class="span8 money" id="custoAtual" name="custoAtual" required="">

                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Situação Skyhub</label>
                            <div class="controls">
                                <select id="situacao" name="situacao" class="span3">

                                    {if $PRODUTO.statusSkyhub == 'noSend'}
                                        <option value="enabled">Habilitar</option>
                                        <option value="noSend" selected="">Não Enviar</option>
                                    {else}
                                        <option value="enabled" {if $PRODUTO.statusSkyhub == 'enabled'}selected=""{/if}>Habilitar</option>
                                        <option value="disabled" {if $PRODUTO.statusSkyhub == 'disabled'}selected=""{/if}>Desabilitar</option>
                                    {/if}

                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Estoque Minimo Skyhub</label>
                            <div class="controls">
                                <div class="input-prepend"> 
                                    <input type="number" placeholder="Estoque mínimo" value="{$PRODUTO.estoqueMinimoSkyhub}" class="span8" id="estoqueMinimoSkyhub" name="estoqueMinimoSkyhub" required="">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Qtd Disponível</label>
                            <div class="controls">
                                <div class="input-prepend"> 
                                    <input type="number" placeholder="Estoque disponivel" value="{$PRODUTO.unidades}" class="span8" id="unidades" name="unidades" >
                                </div>
                            </div>
                        </div>


                        <div class="container-fluid">
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="widget-box">
                                        <div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
                                            <h5>Sinopse</h5>
                                        </div>
                                        <div class="widget-content"> 
                                            <textarea name="sinopse" id="sinopse" style="width: 100%; height: 200px;" required="">{$PRODUTO.full_desc}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>                       
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
