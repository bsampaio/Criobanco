<?php
/**
 * Created by PhpStorm.
 * User: criativa
 * Date: 24/09/15
 * Time: 14:30
 */

namespace App\Service;

use App\Models\Event;
use App\Models\Subscribe;

class EventManager
{
    /**
     * @param Event $event
     * @param array $data
     * @return bool|static
     */
    public function subscribe(Event $event, array $data)
    {
        $requesterCount = $this->countRequesters($data);
        
        $subscribers = $event->subscribers;
        
        $count = 0;
        foreach($subscribers as $subscriber){
            $count += $this->verifyDad($subscriber);
            $count += $this->verifyMom($subscriber);
            $count += $this->verifyChildren($subscriber);
        }
        
        if($count + $requesterCount <= $event->vagas){

            try {
                Subscribe::create(array_merge(['evento_id' => $event->id], $data));
            } catch(\Exception $e) {
                header('HTTP/1.1 500 Internal Server Error');
                return 'Ocorreu um erro ao salvar os dados';
            }

            return 'Cadastrado com sucesso';
        }

        header('HTTP/1.1 500 Internal Server Error');
        return 'Limite de vagas atingido. Por favor, escolha um outro horário';
    }

    /**
     * @param array $data
     * @return int
     */
    private function countRequesters(array $data)
    {
        $count = 0;
        if(isset($data['nome_pai']))
            $count++;
        if(isset($data['nome_mae']))
            $count++;
        if(isset($data['filhos']))
            $count += $data['filhos'];

        return $count;
    }

    /**
     * @param Subscribe $subscriber
     * @return int
     */
    private function verifyDad(Subscribe $subscriber)
    {
        if($subscriber->nome_pai != '')
            return 1;
        return 0;
    }

    /**
     * @param Subscribe $subscriber
     * @return int
     */
    private function verifyMom(Subscribe $subscriber)
    {
        if($subscriber->nome_mae != '')
            return 1;
        return 0;
    }

    /**
     * @param Subscribe $subscriber
     * @return int
     */
    private function verifyChildren(Subscribe $subscriber)
    {
        return $subscriber->filhos;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEvent($id)
    {
        return Event::findOrFail($id);
    }

    /**
     * Obtém os inscritos de um determinado evento
     * @param Event $event
     * @return mixed
     */
    public function getSubscribers(Event $event)
    {
        return $event->subscribers->all();
    }
}