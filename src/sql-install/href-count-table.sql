--
-- Struttura della tabella `href_count`
--

CREATE TABLE `href_count` (
  `_id` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Indici per le tabelle `href_count`
--
ALTER TABLE `href_count`
  ADD PRIMARY KEY (`_id`);

--
-- AUTO_INCREMENT per la tabella `href_count`
--
ALTER TABLE `href_count`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT;