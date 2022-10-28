<?php
/**
 * B2W Digital - Companhia Digital
 *
 * Do not edit this file if you want to update this SDK for future new versions.
 * For support please contact the e-mail bellow:
 *
 * sdk@e-smart.com.br
 *
 * @category  SkuHub
 * @package   SkuHub
 *
 * @copyright Copyright (c) 2018 B2W Digital - BSeller Platform. (http://www.bseller.com.br).
 *
 * @author    Tiago Sampaio <tiago.sampaio@e-smart.com.br>
 */

namespace SkyHub\Api\EntityInterface;

use SkyHub\Api\Handler\Request\Sync\QuestionsHandler;

class Questions extends EntityAbstract
{
    
    /**
     * @return \SkyHub\Api\Handler\Response\HandlerInterface
     */
    public function questions()
    {
        /** @var QuestionsHandler $handler */
        $handler = $this->requestHandler();
        return $handler->questions();
    }
    
    
    /**
     * @param string $questionId
     *
     * @return \SkyHub\Api\Handler\Response\HandlerInterface
     */
    public function showQuestion($questionId)
    {
        /** @var QuestionsHandler $handler */
        $handler = $this->requestHandler();
        return $handler->showQuestion($questionId);
    }
    
    
    /**
     * @param $questionId
     *
     * @return \SkyHub\Api\Handler\Response\HandlerInterface
     */
    public function deleteQuestion($questionId)
    {
        /** @var QuestionsHandler $handler */
        $handler = $this->requestHandler();
        return $handler->deleteQuestion($questionId);
    }
    
    
    /**
     * @param string $questionId
     * @param string $message
     *
     * @return \SkyHub\Api\Handler\Response\HandlerInterface
     */
    public function answerQuestion($questionId, $message)
    {
        /** @var QuestionsHandler $handler */
        $handler = $this->requestHandler();
        return $handler->answerQuestion($questionId, $message);
    }
}